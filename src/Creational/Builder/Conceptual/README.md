# Builder Design Pattern

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
