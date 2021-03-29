## Author
* **Mahamat Tahir Brahim Tidjani**

## Whats Including In This Repository
We have implemented below ** A application to get all the cities on a JSON format **.

## Run The Project
You will need the following tools:

* [Visual Studio 2019](https://visualstudio.microsoft.com/downloads/)
* [.Net Core 3.1 or later](https://dotnet.microsoft.com/download/dotnet-core/3.1)
* [Docker Desktop](https://www.docker.com/products/docker-desktop)

### Installing
Follow these steps to get your development environment set up: (Before Run Start the Docker Desktop)
1. Clone the repository
2. At the root directory which include **Dockerfile.yml** files, run below command to build the image:
```csharp
docker build .
```
3. At the root directory which include **Dockerfile.yml** files, run below command to create a container from the image:
```csharp
docker run weatherapp:dev -p 32770:80 --name WeatherApp
```
4. Wait for docker build the image. That’s it!

5. Launch  http://localhost:32770/weatherforecast in your browser to view the JSON Response.


## Front End
The front end is based on :
- AngularJs : javascript library to manange data generated from the backend in the front end
- Bootstrap : styling library to display the page content 
- HTML 5 :  structure data in the web page and make it compatible with Voice Over
- JQuery : javascript library to handle user touch actions
- LoopifyJs : javascript library to make playing seamless looping audio files

## Back End PHP
The back end file is gathering data (date and city name) from the front end and send it to the weather API in order to send back the weather forcast to the website :
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


## RAPPORT du Projet
** Introduction 
** Description du contexte 
** Travail personnel réalisé 
** Retour personnel sur le projet 
** Projection, reste à faire 
** Conclusion