## Author
* **Mahamat Tahir Brahim Tidjani**

## What's Included In This Repository
This is an implementation of **a weather forcast application for blind people. The application retrieves a list of cities on a JSON format and display corresponding temperature**.

## Run The Project
The following tools are needed in order to run the project:

* [IDE: Visual Studio 2019](https://visualstudio.microsoft.com/downloads/)
* [.Net Core 3.1 or later](https://dotnet.microsoft.com/download/dotnet-core/3.1)
* [Docker Desktop](https://www.docker.com/products/docker-desktop)
* [Docker Compose](https://docs.docker.com/compose/install/)

### Installation
To setup a local environment, follow the below steps: (Before Run Start the Docker Desktop)
1. Clone the repository
```csharp
git clone https://gitlab.com/iamtah3r/sonicast.git
```
2. The are 2 directories: FrontEnd includes the application UI files and BackEnd includes all related dependencies for .Net. Run below commands to build the images for FrontEnd and BackEnd (2 actions):

**FrontEnd**
```csharp
docker build -t iamtah3r/sonicast_front:1.0 FrontEnd/
```
**BackEnd**
```csharp
docker build -t iamtah3r/sonicast_back:1.0 BackEnd/
```
3. At the root directory which include **docker-compose.yaml** file, run below command to create 2 containers from the images created above:

```csharp
docker-compose up
```

4. Wait for docker to build the images and run them. That’s it!

5. Launch  http://localhost:8000 in your browser to access the application.

6. Launch  http://localhost:8001/weatherforecast/all in your browser to view the JSON response.

## FrontEnd
The FrontEnd is based on :
- AngularJs : javascript library to manange data generated from the BackEnd in the web page
- Bootstrap : styling library to display the page content 
- HTML 5 :  structure data in the web page and make it compatible with Voice Over
- JQuery : javascript library to handle user touch actions
- LoopifyJs : javascript library to make playing seamless looping audio files

## BackEnd PHP
The BackEnd file is gathering data (date and city name) from the FrontEnd and send it to the weather API in order to send back the weather forcast to the website :
* 1. Getting city name and date from the front end
* 2. Cheking date :
  * 2.1 if the date is in the past, the system will block it
  * 2.2 if the date in the future,the system will set the hour will begin at 12 am
  * 2.3 if the date is today,the system will get the current hour
* 3. Converting city name to city coordinates (lattitude and longitude)
* 4. Getting weather data from the weather API
* 5. Converting wind speed format from mm/s to knocks
* 6. Assigning raining values to sound index
* 7. Creating new output Format for the front end 

## Audio Component
The Audio player is using [Loopify.js](https://github.com/veltman/loopify), created by [Noah Veltman ](https://github.com/veltman).
In this project the player can be found in ./audio/js/loopify.js.
We then created some basic functions in utils.js.
### The audio files
the format used is .wav, but any compatible type could also be used (.m4a,mp3...)
### How to use Loopify.js ?
1. Call the script in your HTML file:
```javascript 1.8
<script src="loopify.js" type="text/javascript"></script>
```
2. Load the file you want to play(in Javascript) with :
```javascript 1.8
loopify("thePathToTheFile.AnyFormat",function(err,loop) {

// If something went wrong, `err` is supplied
if (err) {
return console.err(err);
}

// Play it whenever you want
loop.play();

// Stop it later if you feel like it
loop.stop();

});
```
According to the documentation provided by the author.

⚠️ ️<span style="color:red"> Warning </span> ⚠️
Loopify.js doesnt work with **Safari** !!
but it does with **Firefox** and **Chrome**