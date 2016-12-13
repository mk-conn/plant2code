# Plant2Code

Plant2Code can be used to generate (currently only PHP) classes from your [plantuml](http://plantuml.com/class-diagram) class diagramm. 
It converts the plantuml class diagramm into XMI and creates the target language class files based on the XMI declarations.

## Requirements

* current Java RE (on Mac the JDK is required) - don't know about Windows systems, I didn't and will not test there. 
* PHP >= 7.x
* [Composer](https://getcomposer.org) 

## Installation

Clone or download this repository. Run `composer install --no-dev` from the root directory (omit the --no-dev option, if you intend 
to develop in this project). Done.

### Running

```
php plant2code:convert path/to/input.puml path/to/output/dir [language]
```

### Tips

Although it is possible to write class properties and methods like this in plantuml:
```
class Test {
    string #name // or #string name
}
```
the required syntax for plant2code to work correctly is:
```
class Test {
    #name : string
    
    +update(arg1 : int, arg2 string)
}
```


### Thanks

Thanks goes out to the plantuml developers who let me use the binary **plantuml.jar** which is distributed under LGPL.

And finally another big thanks to the developers who implemented my suggestions and wishes in no time very quick!