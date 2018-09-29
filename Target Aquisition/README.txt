#Please Note:  All art and sound assets have been removed to reduce the size of
of the archive.

##WebCode:##
    The files in the base directory are index.php and main.css.  These are
    the files that the user will see when they virst visit the website.

    \admin
        The files that pertain to the Administrative Data Panel are inside this
        directory.

    \db_connect
        The PHP files we use for interacting with the database.

    \target_hunter
        The game that is exported from the Game Engine.


##GameCode:##
    The files contained in the top level of this directory are used by the Game
    Engine to define how the editor should load.  All code is broken into the
    sub directories.

    \custom_export
        The custom html/php and css files used when we export from the engine.
        
        When we export the project from the engine, it takes in a custom html
        wrapper and injects some code into it.  We then rename the file to a 
        php when we push it to production.  This is because some variables in
        the file need to come from the database before the game starts.

    \src
        The src folder contains all of the custom game logic code that runs
        while the game is running.  This is where the bulk of the work went
        as far as coding goes.

    \screens
        The game divides discrete scenes into "screens."  There is a Main Menu, 
        Playing and Score screen.  Each specific game object is also a screen,
        that is, the animation player, the sound player, these are all screens.
    
    \targets
        Like most other game objects, targets are also defined as a screen/scene.
        We placed the target screens inside of a different folder to keep things
        more organized.

    \themes
        Each theme is also defined as a screen/scene.  Each one defines how the
        buttons/panels of a screen should look when a theme is applied.