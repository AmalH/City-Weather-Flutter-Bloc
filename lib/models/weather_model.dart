import 'package:flutter/cupertino.dart';
import 'package:weather/weather.dart';
import 'package:weather_icons/weather_icons.dart';

class WeatherModel {
  String? city;
  double? currentTempC;
  IconData icon = WeatherIcons.na;
  bool isEmpty = false;

  WeatherModel(Weather weather) {
    this.city = weather.areaName;
    this.currentTempC = weather.temperature?.celsius ?? 0.0;
    this.icon = conditionIconFromCode(weather.weatherIcon ?? "");
  }

  WeatherModel.empty() {
    isEmpty = true;
    this.currentTempC = 0;
  }

  WeatherModel.test({this.city, this.currentTempC, required String code}) {
    this.isEmpty = false;
    this.icon = conditionIconFromCode(code);
  }

  IconData conditionIconFromCode(String code) {
    switch (code) {
      case "01d":
        return WeatherIcons.day_sunny;
      case "02d":
        return WeatherIcons.day_cloudy;
      case "03d":
        return WeatherIcons.cloud;
      case "04d":
        return WeatherIcons.cloudy;
      case "09d":
        return WeatherIcons.raindrops;
      case "10d":
        return WeatherIcons.day_rain_mix;
      case "11d":
        return WeatherIcons.storm_warning;
      case "13d":
        return WeatherIcons.snow;
      case "50d":
        return WeatherIcons.day_fog;
      case "01n":
        return WeatherIcons.night_clear;
      case "02n":
        return WeatherIcons.night_cloudy;
      case "03n":
        return WeatherIcons.night_alt_cloudy;
      case "04n":
        return WeatherIcons.night_alt_cloudy_high;
      case "09n":
        return WeatherIcons.night_rain_mix;
      case "10n":
        return WeatherIcons.night_alt_rain_wind;
      case "11n":
        return WeatherIcons.night_storm_showers;
      case "13n":
        return WeatherIcons.snow;
      case "50n":
        return WeatherIcons.night_fog;
    }
    return WeatherIcons.na;
  }
}
