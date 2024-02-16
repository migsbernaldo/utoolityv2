#include <SPI.h>
#include <Ethernet.h>
#include <SD.h>
#include <EEPROM.h>

byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };
IPAddress ip(172, 16, 2, 252);         
IPAddress subnet(255, 255, 255, 0);
IPAddress gateway(172, 16, 2, 1);

EthernetClient client;
EthernetServer server(50001);

const int ACU_PIN = 8;  // pin for ACU(Air Conditioner Breaker)
bool acuStatus;
const int LIGHT_PIN = 9;  // pin for lights
bool lightStatus;
const int REMOTE_PIN = 3;  // pin for remote
bool remoteStatus;

const int TEMPHIGH_PIN = 5;  // pin for temperature increase
const int TEMPLOW_PIN = 7;   // pin for temperature decrease
const int TEMP_MIN = 17;
const int TEMP_MAX = 30;
int temperature = 20;

const int PAIRING_PIN = 5;  // pin for remote pairing

void setup() {
  Serial.begin(9600);  // Start the serial communication
  Ethernet.begin(mac, ip, subnet, gateway);  // Initialize the Ethernet shield with the MAC address and IP address
  server.begin();
  Serial.print("Arduino IP Address: ");
  Serial.println(Ethernet.localIP());
  Serial.print("Gateway IP: ");
  Serial.println(Ethernet.gatewayIP());
  SD.begin(4);  // Initialize the SD card

  pinMode(ACU_PIN, OUTPUT);
  pinMode(LIGHT_PIN, OUTPUT);
  pinMode(REMOTE_PIN, OUTPUT);
  pinMode(TEMPHIGH_PIN, OUTPUT);
  pinMode(TEMPLOW_PIN, OUTPUT);
  pinMode(PAIRING_PIN, OUTPUT);

  lastState();
}

void loop() {
  EthernetClient client = server.available();  // check for incoming client requests

  if (client) {
    String request = client.readStringUntil('\r');  // read the HTTP request

    if (request.indexOf("GET /") != -1) {  // if the request is for the root directory
      client.println("HTTP/1.1 200 OK");   // send HTTP response headers
      client.println("Content-Type: text/html");
      client.println();

      File htmlFile = SD.open("ui.htm");  // open the HTML file on the SD card

      if (htmlFile) {  // if the file opened successfully
        while (htmlFile.available()) {
          client.write(htmlFile.read());  // send the file contents to the client
        }
        htmlFile.close();  // close the file
      } else {             // if the file failed to open
        client.println("Error opening file");
      }
    }

    controls(request);

    client.stop();  // close the connection
  }
}

void lastState() {
  // Last state of ACU
  acuStatus = EEPROM.read(0);
  digitalWrite(ACU_PIN, acuStatus ? LOW : HIGH);
  Serial.print("ACU is " + String(acuStatus ? "ON" : "OFF") + ",");

  // Last state of lights
  lightStatus = EEPROM.read(1);
  digitalWrite(LIGHT_PIN, lightStatus ? LOW : HIGH);
  Serial.print("Light is " + String(lightStatus ? "ON" : "OFF") + ",");

  // Last state of remote
  remoteStatus = EEPROM.read(2);
  digitalWrite(REMOTE_PIN, HIGH);
  Serial.print("Remote is " + String(remoteStatus ? "ON" : "OFF") + ",");

  // Last state of temperature
  temperature = EEPROM.read(3);
  digitalWrite(TEMPHIGH_PIN, HIGH), digitalWrite(TEMPLOW_PIN, HIGH);
  Serial.println("Temperature: " + String(temperature));
}


void controls(String request) {
  // controls for ACU/////////////////////////////////////////
  if (request.indexOf("?acuOn") > 0) {
    if (!acuStatus) {
      digitalWrite(ACU_PIN, LOW);
      Serial.println("ACU turned ON");
      acuStatus = true;
      EEPROM.write(0, acuStatus);
      EEPROM.end();
    }
  } else if (request.indexOf("?acuOff") > 0) {
    if (acuStatus) {
      digitalWrite(ACU_PIN, HIGH);
      Serial.println("ACU turned OFF");
      acuStatus = false;
      EEPROM.write(0, acuStatus);
      EEPROM.end();
    }
  }
  // control for lights/////////////////////////////////////////
  if (request.indexOf("?lightsOn") > 0) {
    if (!lightStatus) {
      digitalWrite(LIGHT_PIN, LOW);
      Serial.println("Light turned ON");
      lightStatus = true;
      EEPROM.write(1, lightStatus);
      EEPROM.end();
    }
  } else if (request.indexOf("?lightsOff") > 0) {
    if (lightStatus) {
      digitalWrite(LIGHT_PIN, HIGH);
      Serial.println("Light turned OFF");
      lightStatus = false;
      EEPROM.write(1, lightStatus);
      EEPROM.end();
    }
  }
  // controls for remote/////////////////////////////////////////
  if (request.indexOf("?remoteOn") > 0) {
    if (!remoteStatus) {
      digitalWrite(REMOTE_PIN, LOW);
      delay(1000);
      digitalWrite(REMOTE_PIN, HIGH);
      Serial.println("Remote turned ON");
      remoteStatus = true;
      EEPROM.write(2, remoteStatus);
      EEPROM.end();
    }
  } else if (request.indexOf("?remoteOff") > 0) {
    if (remoteStatus) {
      digitalWrite(REMOTE_PIN, LOW);
      delay(1000);
      digitalWrite(REMOTE_PIN, HIGH);
      Serial.println("Remote turned OFF");
      remoteStatus = false;
      EEPROM.write(2, remoteStatus);
      EEPROM.end();
    }
  }
  // controls for temperature/////////////////////////////////////////
  if (request.indexOf("?tempInc") > 0) {
    digitalWrite(TEMPHIGH_PIN, LOW);
    delay(1000);
    digitalWrite(TEMPHIGH_PIN, HIGH);
    temperature++;
    if (temperature > TEMP_MAX) {
      temperature = TEMP_MAX;  // Limit value to maximum
    }
    Serial.println("Temperature increased to: " + String(temperature));
    EEPROM.write(3, temperature);
    EEPROM.end();
  } 
  if (request.indexOf("?tempDec") > 0) {
    digitalWrite(TEMPLOW_PIN, LOW);
    delay(1000);
    digitalWrite(TEMPLOW_PIN, HIGH);
    // temperature = 20;
    temperature--;
    if (temperature < TEMP_MIN) {
      temperature = TEMP_MIN;  // Limit value to minimum
    }
    Serial.println("Temperature decreased to: " + String(temperature));
    EEPROM.write(3, temperature);
    EEPROM.end();
  }
  // controls for remote pairing to Air Conditioner/////////////////////////////////////////
  if (request.indexOf("?pairing") > 0) {
    digitalWrite(PAIRING_PIN, LOW);
    Serial.print("Pairing countdown...");
    for (int i = 15; i >= 0; i--) {
      Serial.print(i);  // Print the current countdown value
      Serial.print(",");
      delay(1000);  // Wait for 1 second before printing the next number
    }
    digitalWrite(PAIRING_PIN, HIGH);
    Serial.println("...Paired");
  }
}
