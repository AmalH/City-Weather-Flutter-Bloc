import 'package:weather/weather.dart';
import 'package:weatherapp/models/weather_model.dart';

import 'package:flutter_bloc/flutter_bloc.dart';
import 'package:weatherapp/utils/config.dart';

class WeatherCubit extends Cubit<WeatherModel> {
  WeatherFactory? wf;
  String city = "";

  WeatherCubit(WeatherModel initialState) : super(initialState) {
    wf = new WeatherFactory(Config.apikey);
  }

  Future<void> fetchWeather() async {
    if (wf != null) {
      var weather;
      try {
        weather = await wf!.currentWeatherByCityName(city);
        emit(WeatherModel(weather));
      } on Exception catch (e) {
        print(e);
        emit(WeatherModel.empty());
      }
    } else {
      emit(WeatherModel.empty());
    }
  }

  setCity(String city) {
    this.city = city;
  }
}
