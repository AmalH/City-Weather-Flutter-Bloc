import 'package:flutter/material.dart';
import 'package:weatherapp/models/weather_model.dart';
import 'package:weatherapp/pages/home_page.dart';
import 'package:flutter_bloc/flutter_bloc.dart';

import 'cubit/weather_cubit.dart';

Future<void> main() async {
  runApp(MyApp());
}

class MyApp extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'City Weather App',
      theme: ThemeData(
        primarySwatch: Colors.indigo,
      ),
      home: BlocProvider(
          create: (BuildContext context) => WeatherCubit(WeatherModel.empty()),
          child: MyHomePage()),
    );
  }
}
