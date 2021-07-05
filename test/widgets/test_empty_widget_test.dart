import 'package:flutter/material.dart';
import 'package:flutter_test/flutter_test.dart';
import 'package:weatherapp/models/weather_model.dart';
import 'package:weatherapp/widgets/widget_weather.dart';

void main() {
  group('WeatherModel.empty', () {
    testWidgets('renders correct text for CustomWeatherDisplay',
        (tester) async {
      await tester.pumpWidget(
        MaterialApp(
          home: Scaffold(
            body: CustomWeatherDisplay(
              weather: WeatherModel.empty(),
            ),
          ),
        ),
      );
      expect(find.text('Please select a city'), findsOneWidget);
    });
  });
}
