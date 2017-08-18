# Forest-Fire-Monitoring-Dashboard
This is the web-based part from my GDP project called 'Forest Fire Detection Using Wireless Sensor Network Optimized by Solar Power'.


## What does it do?
1. Get temprerature & humidity value from a POST request send from the arduino and save it to MYSQL database & firebase.
  (MYSQL database will save all value while firebase databse will save the latest value.)
2. Show the realtime sensor value in graph and the previous data in table.
3. when the temperature reaches certain value ( in this project, I,ve set the value to 40°C), it will send the notification using firebase cloud messaging to the android app that i've build.


## Screenshot of the web app 
![Screenshot of the dashboard](https://github.com/JohanBrainz/Forest-Fire-Monitoring-Dashboard/blob/master/Screenshot.PNG "Screenshot")
