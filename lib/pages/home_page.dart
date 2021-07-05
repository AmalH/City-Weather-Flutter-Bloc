import 'package:flutter/material.dart';
import 'package:flutter_bloc/flutter_bloc.dart';
import 'package:weatherapp/cubit/weather_cubit.dart';
import 'package:weatherapp/models/weather_model.dart';
import 'package:weatherapp/widgets/widget_weather.dart';

class MyHomePage extends StatelessWidget {
  MyHomePage({Key? key}) : super(key: key);
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('City Weather App'),
      ),
      body: Center(
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          crossAxisAlignment: CrossAxisAlignment.center,
          children: [
            BlocBuilder<WeatherCubit, WeatherModel>(
              builder: (context, weather) =>
                  CustomWeatherDisplay(weather: weather),
            ),
            SizedBox(height: 20.0),
            FractionallySizedBox(
              widthFactor: 0.7,
              child: TextField(
                decoration: InputDecoration(
                  border: const OutlineInputBorder(
                    borderRadius: BorderRadius.all(Radius.circular(25.0)),
                  ),
                  hintText: "Enter a city",
                  contentPadding: EdgeInsets.only(left: 20.0, right: 20.0),
                  hintStyle: TextStyle(fontSize: 20.0),
                  suffixIcon: Icon(
                    Icons.search,
                    size: 35.0,
                  ),
                ),
                onChanged: (val) {
                  context.read<WeatherCubit>().setCity(val);
                },
              ),
            ),
            SizedBox(height: 20.0),
            ElevatedButton(
              style: ElevatedButton.styleFrom(
                primary: Theme.of(context).primaryColor,
                padding: EdgeInsets.symmetric(horizontal: 80.0, vertical: 15.0),
                shape: const RoundedRectangleBorder(
                  borderRadius: BorderRadius.all(Radius.circular(25.0)),
                ),
              ),
              onPressed: () {
                context.read<WeatherCubit>().fetchWeather();
              },
              child: Text(
                'Get Weather',
                style: TextStyle(fontSize: 20.0),
              ),
            )
          ],
        ),
      ),
    );
  }
}
