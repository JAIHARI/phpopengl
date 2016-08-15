
# PHP-OpenGL

PHP bindings for the OpenGL library.

Not all of the OpenGL API is available on this extension. In order to keep the code small, maintainable and hopefully less buggy, it was decided to support only the subset that is not part of the compatibility profile. (glRotate, glBegin, glLight, ...). Compatibility profile usage is discouraged in other platforms and this extension only let you use the modern (core) GL profile. 

## Requirements

- PHP7 with the PHP-SDL extension
- OpenGL libraries
- Linux/MacOS (Windows support coming soon)

## Installation

### Linux

```sh
pecl install phpopengl
```

Or

```sh
git clone git://github.com/ponup/phpopengl.git --recursive phpopengl
cd phpopengl
phpize
./configure --enable-opengl
make
sudo make install
echo extension=opengl.so | sudo tee /etc/php5/conf.d/opengl.ini
```

## Examples

```php
<?php
SDL_Init(SDL_INIT_VIDEO);

SDL_GL_SetAttribute(SDL_GL_CONTEXT_MAJOR_VERSION, 3);
SDL_GL_SetAttribute(SDL_GL_CONTEXT_MINOR_VERSION, 2);

$window = SDL_CreateWindow('3D in PHP', SDL_WINDOWPOS_CENTERED, SDL_WINDOWPOS_CENTERED, 512, 512, SDL_WINDOW_OPENGL | SDL_WINDOW_SHOWN);
$context = SDL_GL_CreateContext($window);

SDL_GL_SetSwapInterval(1);

glClearColor(1.0, 0.0, 0.0, 1.0);
glClear(GL_COLOR_BUFFER_BIT);

SDL_GL_SwapWindow($window);

SDL_GL_DeleteContext($context);
SDL_DestroyWindow($window);
SDL_Quit();
```

## License

GPL-3.0+

