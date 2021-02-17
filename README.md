# Fgsl Genetic Algorithm

## How to run the sample

There is a sample of genetic algorithm application as a an automated test. For running it, first run `composer update` for install the dependencies, and then run:

```bash
vendor/bin/phpunit --bootstrap vendor/autoload.php tests/
```

An example of test output:

```bash
...
Weight summatory:
1* 12 + 0 * 1 + 3 * 4 + 0 * 1 + 2 * 2 = 28

Value summatory:
1* 4 + 0 * 2 + 3 * 10 + 0 * 1 + 2 * 2 = 38

Weight summatory:
1* 12 + 2 * 1 + 0 * 4 + 1 * 1 + 0 * 2 = 15

Value summatory:
1* 4 + 2 * 2 + 0 * 10 + 1 * 1 + 0 * 2 = 9


Time: 8.62 seconds, Memory: 27.46 MB

OK (1 test, 1 assertion)
```

## How to use:

Create a class that implements `Fgsl\GeneticAlgorithm\RulesInterface`. This class must define fitness function and other constraints.

Inject an instance of rules class in an instance of `Fgsl\GeneticAlgorithm\GeneticAlgorithm` and call method `execute`.

You can see processing details enabling verbose parameter in class constructor.
