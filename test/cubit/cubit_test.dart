import 'package:bloc_test/bloc_test.dart';
import 'package:flutter_test/flutter_test.dart';
import 'package:weatherapp/cubit/weather_cubit.dart';
import 'package:weatherapp/models/weather_model.dart';

void main() {
  group('Weatherblock', () {
    setUp(() => {TestWidgetsFlutterBinding.ensureInitialized()});

    late WeatherCubit weatherbloc;

    setUp(() {
      weatherbloc = WeatherCubit(WeatherModel.empty());
    });

    test('initial state is 0', () {
      expect(weatherbloc.state.isEmpty, true);
    });

    blocTest<WeatherCubit, WeatherModel>(
      'emits [1] when fetch event check city of result',
      build: () => weatherbloc,
      act: (cubit) => cubit.setCity("Berlin"),
      expect: () => <WeatherModel>[],
    );
  });
}
