import 'package:flutter_test/flutter_test.dart';
import 'package:weather/weather.dart';
import 'package:weatherapp/utils/config.dart';

void main() {
  group('Weathermap api', () {
    final wf = new WeatherFactory(Config.apikey);

    test('API Key should not be empty', () {
      expect(Config.apikey, isNotEmpty);
    });

    test('Instance weathermap should not be null', () {
      expect(wf, isNotNull);
    });
  });
}
