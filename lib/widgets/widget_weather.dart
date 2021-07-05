import 'package:flutter/material.dart';

import '../models/weather_model.dart';

class CustomWeatherDisplay extends StatelessWidget {
  final WeatherModel weather;
  CustomWeatherDisplay({required this.weather}) {
    print(this.weather);
  }

  @override
  Widget build(BuildContext context) {
    return weather.isEmpty
        ? Center(
            child: Text(
              "Please select a city",
              style: Theme.of(context).textTheme.headline5,
            ),
          )
        : Row(
            crossAxisAlignment: CrossAxisAlignment.center,
            mainAxisSize: MainAxisSize.min,
            mainAxisAlignment: MainAxisAlignment.center,
            children: [
              SizedBox(
                width: 100,
                height: 60,
                child: Icon(
                  weather.icon,
                  size: 60.0,
                ),
              ),
              Column(
                mainAxisAlignment: MainAxisAlignment.start,
                mainAxisSize: MainAxisSize.min,
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text('${weather.currentTempC?.floor()} °C',
                      style: Theme.of(context)
                          .textTheme
                          .headline2
                          ?.copyWith(color: Colors.black)),
                  FittedBox(
                    fit: BoxFit.fitWidth,
                    child: Text(
                      '${weather.city}',
                      style: Theme.of(context).textTheme.headline5,
                      overflow: TextOverflow.ellipsis,
                    ),
                  )
                ],
              )
            ],
          );
  }
}
