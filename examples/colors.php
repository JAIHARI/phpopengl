<?php

dl('sdl.so');
dl('opengl.so');

function exitError($msg) {
    printf("%s: %s\n", $msg, SDL_GetError());
    SDL_Quit();
    exit(1);
}

function checkSDLError($line) {
    $error = SDL_GetError();
    if ($error != null) {
        printf("SDL Error (line %d): %s\n", $line, $error);
        SDL_ClearError();
    }
}

if (SDL_Init(SDL_INIT_VIDEO) < 0) /* Initialize SDL's Video subsystem */
    exitError("Unable to initialize SDL"); /* Or die on error */

/* Request opengl 3.2 context. */
SDL_GL_SetAttribute(SDL_GL_CONTEXT_PROFILE_MASK, SDL_GL_CONTEXT_PROFILE_CORE);
SDL_GL_SetAttribute(SDL_GL_CONTEXT_MAJOR_VERSION, 3);
SDL_GL_SetAttribute(SDL_GL_CONTEXT_MINOR_VERSION, 2);

/* Turn on double buffering with a 24bit Z buffer.
 * You may need to change this to 16 or 32 for your system */
SDL_GL_SetAttribute(SDL_GL_DOUBLEBUFFER, 1);
SDL_GL_SetAttribute(SDL_GL_DEPTH_SIZE, 24);

/* Create our window centered at 512x512 resolution */
$window = SDL_CreateWindow('Changing GL colors', SDL_WINDOWPOS_CENTERED, SDL_WINDOWPOS_CENTERED,
    512, 512, SDL_WINDOW_OPENGL | SDL_WINDOW_SHOWN);
if (!$window) /* Die if creation failed */
    exitError("Unable to create window");

checkSDLError(__LINE__);

/* Create our opengl context and attach it to our window */
$context = SDL_GL_CreateContext($window);
checkSDLError(__LINE__);

/* This makes our buffer swap syncronized with the monitor's vertical refresh */
SDL_GL_SetSwapInterval(1);

/* Clear our buffer with a red background */
glClearColor ( 1.0, 0.0, 0.0, 1.0 );
glClear ( GL_COLOR_BUFFER_BIT );
/* Swap our back buffer to the front */
SDL_GL_SwapWindow($window);
/* Wait 2 seconds */
SDL_Delay(2000);

/* Same as above, but green */
glClearColor ( 0.0, 1.0, 0.0, 1.0 );
glClear ( GL_COLOR_BUFFER_BIT );
SDL_GL_SwapWindow($window);
SDL_Delay(2000);

/* Same as above, but blue */
glClearColor ( 0.0, 0.0, 1.0, 1.0 );
glClear ( GL_COLOR_BUFFER_BIT );
SDL_GL_SwapWindow($window);
SDL_Delay(2000);

/* Delete our opengl context, destroy our window, and shutdown SDL */
SDL_GL_DeleteContext($context);
SDL_DestroyWindow($window);
SDL_Quit();

