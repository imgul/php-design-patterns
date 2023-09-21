# Builder Design Pattern

## Table of Contents

- [Builder Design Pattern](#builder-design-pattern)
  - [Table of Contents](#table-of-contents)
  - [Concept](#concept)
  - [Intent](#intent)
  - [Problem](#problem)
  - [Solution](#solution)
  - [How to Implement](#how-to-implement)
  - [Applicability](#applicability)
  - [Real World Examples](#real-world-examples)
  - [Relations with Other Patterns](#relations-with-other-patterns)
  - [How I can remember it?](#how-i-can-remember-it)
  - [How I implemented in PHP](#how-i-implemented-in-php)

## Concept

The Builder pattern suggests that you extract the object construction code out of its own class and move it to separate objects called builders. The pattern organizes object construction into a set of steps (processPartA, processPartB, etc.). To create an object, you execute a series of these steps on a builder object. The important part is that you don’t need to call all of the steps. You can call only those steps that are necessary for producing a particular configuration of an object.

## Intent

Builder is a creational design pattern that lets you construct complex objects step by step. The pattern allows you to produce different types and representations of an object using the same construction code.

## Problem

Imagine a complex object that requires laborious, step-by-step initialization of many fields and nested objects. Such initialization code is usually buried inside a monstrous constructor with lots of parameters. Or even worse: scattered all over the client code.

## Solution

The Builder pattern suggests that you extract the object construction code out of its own class and move it to separate objects called builders.

The pattern organizes object construction into a set of steps (processPartA, processPartB, etc.). To create an object, you execute a series of these steps on a builder object. The important part is that you don’t need to call all of the steps. You can call only those steps that are necessary for producing a particular configuration of an object.

Another useful feature of the Builder pattern is that you can defer execution of some steps without breaking the final product. You can call a build method to get the result, and then call other build methods to get another result. The Builder doesn’t depend on concrete products. It works with their common interface. Therefore you can pass a builder object to the client code without breaking it.

## How to Implement

1. Make sure that you can clearly define the common construction steps for building all available product representations. Otherwise, you won’t be able to proceed with implementing the pattern. 
2. Declare these steps in the base builder interface. i.e. `Builder.php`
3. Create a concrete builder class for each of the product representations and implement their construction steps. i.e. `ConcreteBuilder.php`
4. Think of adding a method for fetching the result of the construction. The director class can use this method to retrieve the product. i.e. `getProduct()`
5. Add an ability to reset the building steps. The director may need this feature if it works with the several products built by the same builder instance. i.e. `reset()` and inside the method `product = new Product()`
6. It’s not necessary to extract the product construction code into a builder class. This code may reside inside a complex component itself. The director class can delegate building to that component. i.e. `Director.php`
7. Although the client should usually be unaware of the concrete builder’s class, you can retrieve the result from a builder without coupling it to the specific builder class. i.e. `Client.php`
8. The base builder class can be a useful place for storing the common construction code, such as initializing the product. All concrete builders can inherit this code from the base class.
9. If your programming language supports a way to denote a method as abstract, you can make the base builder class abstract to force all builders to implement the construction steps.
10. Alternatively, you can make the builder class a static class and use static methods. This approach is less flexible and often less clear than the previous one.
11. The builder’s code may create a complex product in a single pass. Alternatively, you can design the builder to construct the product in several different passes, i.e., the builder asks for the product parts one by one, then aggregates them into the final product. This makes sense when constructing a complex product is a step-by-step process. While this approach makes the builder a bit more complicated, it eliminates the need to keep the product’s state in the builder class and thus reduces the memory footprint of products. i.e. `Builder.php` and `ConcreteBuilder.php`

## Applicability

- Use the Builder pattern to get rid of a “telescopic constructor”.
- Use the Builder pattern when you want your code to be able to create different representations of some product (for example, stone and wooden houses).
- Use the Builder to construct Composite trees or other complex objects.
- Use the Builder pattern to construct Product in several steps.
- Use the Builder pattern when you want to create a Product's different representations and reuse its internal construction logic.
- Use the Builder pattern when you need to create an object with a lot of possible configuration options. The Builder pattern can be used to initialize the product step by step.
- Use the Builder pattern when you want to isolate the business logic of constructing a complex object from the code that actually implements it.
- Use the Builder pattern when you want to construct a complex object (for example, a tree) from simple objects (for example, a bunch of leaves).
- Use the Builder pattern when you want to construct a complex object (for example, a tree) from simple objects (for example, a bunch of leaves).

## Real World Examples

- [Symfony FormBuilder](https://symfony.com/doc/current/forms.html#creating-form-classes)
- [Laravel FormBuilder](https://laravelcollective.com/docs/6.x/html#form-model-binding)
- [Doctrine QueryBuilder](https://www.doctrine-project.org/projects/doctrine-orm/en/latest/reference/query-builder.html)
- [Laravel QueryBuilder](https://laravel.com/docs/10.x/queries)
- [Laravel Eloquent](https://laravel.com/docs/10.x/eloquent)
- [Doctrine ORM](https://www.doctrine-project.org/projects/doctrine-orm/en/latest/)
- [Doctrine DBAL](https://www.doctrine-project.org/projects/doctrine-dbal/en/latest/)

## Relations with Other Patterns

- Many designs start by using Factory Method (less complicated and more customizable via subclasses) and evolve toward Abstract Factory, Prototype, or Builder (more flexible, but more complicated).
- Builder focuses on constructing complex objects step by step. Abstract Factory specializes in creating families of related objects. Abstract Factory returns the product immediately, whereas Builder lets you run some additional construction steps before fetching the product.
- - You can combine Builder with Abstract Factory to use the factory classes for creating different representations of a complex product.
- You can combine Builder with Bridge: the director class plays the role of the abstraction, while different builders act as implementations.
- You can combine Builder with Prototype to save copies of complex objects as prototypes.
- You can combine Builder with Prototype to let you clone existing products without making your code dependent on their classes.
- You can combine Builder with Facade to build a complex object in steps. The director class plays the role of the facade.
- You can use Builder along with Iterator to let you construct complex objects and then traverse them step by step.
- You can use Builder when a complex object should be built in multiple steps, which can be useful when constructing trees or other complex objects.
- You can combine Builder with Memento to implement undoable step-by-step initialization.
- You can combine Builder with Visitor to create an object with a complex structure. The visitor class defines the type of the object structure, and the concrete visitor class implements the operations to be performed on that structure. The builder class creates the complex object by accepting a visitor object and calling its methods for each component of the structure being built.
- You can combine Builder with Composite to create a tree-like object structure.
- You can combine Builder with Decorator to let you construct complex objects step by step. Concrete decorators aren’t required to know about the specific steps performed by the builder.
- You can combine Builder with Chain of Responsibility to build an object out of several parts and then let the request pass through the resulting structure.
- You can combine Builder with Command to create a queue of commands for the step-by-step construction of a complex object. The commands let you traverse the complex object, step by step, as well as execute the final creation step.
- You can combine Builder with Strategy: the director class configures the builder with a particular strategy, which is then used by the builder to perform the construction steps.
- You can combine Builder with Observer to let a builder notify other objects about the changes to the object being built.
- You can combine Builder with State to let the builder change the product’s internal state as it moves through the construction steps.
- You can combine Builder with Flyweight to share the common parts of the built objects between various objects.
- You can combine Builder with Proxy to let the builder control the access to the product’s internals.
- You can combine Builder with Singleton to let the builder create singleton products.
- You can combine Builder with Command to build a representation of commands in a specific syntax (such as a programming language).
- You can combine Builder with Interpreter to create an abstract syntax tree (AST) for a simple language.
- You can combine Builder with Template Method: the director class plays the role of the template method, while different builders act as concrete steps.
- You can combine Builder with Mediator to build a mediator that configures the building steps of various products.

## How I can remember it?

- If you want to build a complex object without having to create a separate class for each of the possible configurations, use the Builder pattern.
- If you want to build a complex object using a step-by-step approach without creating a constructor overload for each step, use the Builder pattern.
- If you want to build a complex object that should be immutable, use the Builder pattern.
- If you want to hide the construction of a complex object from its representation, use the Builder pattern.
- If you want to create an object in several steps, use the Builder pattern.
- If you want to reuse the same construction code when building various representations of products, use the Builder pattern.
- If you want to compose complex objects from simpler ones, use the Builder pattern.

## How I implemented in PHP

- [Builder](Builder.php)
- [ConcreteBuilder1](ConcreteBuilder1.php)
- [Product1](Product1.php)
- [Director](Director.php)
- [Client](Client.php)

