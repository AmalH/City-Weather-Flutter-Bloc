import 'package:flutter/material.dart';
import 'package:flutter_test/flutter_test.dart';
import 'package:weather_icons/weather_icons.dart';
import 'package:weatherapp/models/weather_model.dart';
import 'package:weatherapp/widgets/widget_weather.dart';

void main() {
  group('WeatherModel sunny day', () {
    testWidgets('renders correct text for CustomWeatherDisplay',
        (tester) async {
      await tester.pumpWidget(
        MaterialApp(
          home: Scaffold(
            body: CustomWeatherDisplay(
              weather: WeatherModel.test(
                  city: 'test city 123', currentTempC: 20.0, code: '01d'),
            ),
          ),
        ),
      );
      expect(find.text('test city 123'), findsOneWidget);
      expect(find.text('Please select a city'), findsNothing); // error case
      expect(find.textContaining('20 °C'), findsOneWidget);
      expect(find.byIcon(WeatherIcons.day_sunny), findsOneWidget);
    });
  });
}
