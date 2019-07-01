## About
I have decided to use feature oriented onion architecture. Code is divided to use cases in the `src/` folder.
This makes the application scalable and maintainable. The application layer uses command-handler pattern
to easily separate business logic from controllers.

### Benchmark use case:

#### Benchmarks:
Benchmark use case is divided into 2 sections - the actual benchmark, in this case 'LoadingTime', and Report.

To add new benchmark type, create a new folder for it and make the output model class that implements 
`App\Benchmark\Domain\Report\Model\Data`. This will be further used to create reports.

#### Reports:
Report converters take models that implement `Data interface` and convert them to the Report. Reports are divided into 
`Sections` with `App\Benchmark\Domain\Report\Model\Section`. To modify existing report, simply add/remove new `Sections`.

To create a new Report, add new folder in `App\Benchmark\Domain\Report\Service` with `ReportFactory` that
implements `App\Benchmark\Domain\Report\Service\ReportFactory`. Than make a new `Create*BenchmarkCommand` and `Handler` 
in the application layer.


## Set up

Clone the repository, enter the main folder and run:

```
cp docker-compose-dev.dist.yaml docker-compose.yaml &&\
cp .env.dist .env
```

The default configuration should work but if You have some port conflicts
update the docker-compose.yaml according to needs.

Than run:
```
docker-compose up -d
```

When containers are up and running, execute:
```
docker exec -it speed_php composer install
```

Finally update your hosts file with:
```
127.0.0.1       speed.loc
```

## Usage

To create a benchmark make a `POST` request to `http://localhost:7000/api/benchmark`.

Example payload:
```
{
	"email": "email@example.com",
	"phoneNumber": "555-55-55",
	"benchmarkUrl": "http://www.wp.pl",
	"comparedUrls": [
			"http://www.onet.pl",
			"http://www.google.com"
		]
}
```

If You encounter file permissions problem run: 
```
docker exec -it speed_php chmod -R 777 /var/www/symfony/var/log
```

## Tests
I decided to test only the Benchmark use case, to save some time. Tests are in the `/tests` folder, and are divided
to `Unit` and `Integration` tests. To run the tests execute:

```
docker exec -it speed_php bin/phpunit
```