# Dockerfile for Sonicast BackEnd
# Use aspnet:3.1-buster-slim AS base
FROM mcr.microsoft.com/dotnet/core/aspnet:3.1-buster-slim AS base

#Position in app directory
WORKDIR /app

#Expose port 8081
EXPOSE 8081

# Build image from sdk:3.1-buster AS build
FROM mcr.microsoft.com/dotnet/core/sdk:3.1-buster AS build

#Position in src directory
WORKDIR /src

# Copy WeatherApp.csproj
COPY ["WeatherApp.csproj", ""]

# Run the dependencies for WeatherApp.csproj
RUN dotnet restore "./WeatherApp.csproj"

# Copy all current contents
COPY . .
WORKDIR "/src/."

# Build WeatherApp.csproj and all of its dependencies
RUN dotnet build "WeatherApp.csproj" -c Release -o /app/build

FROM build AS publish

# Publishes the application and its dependencies to a folder for deployment to a hosting
RUN dotnet publish "WeatherApp.csproj" -c Release -o /app/publish
 
FROM base AS final
WORKDIR /app
COPY --from=publish /app/publish .
ENTRYPOINT ["dotnet", "WeatherApp.dll"]