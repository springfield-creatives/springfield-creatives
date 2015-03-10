<?php

function remove_menus(){

  //Dashboard
  remove_menu_page( 'index.php' );               

  //Posts   
  // remove_menu_page( 'edit.php' );                  

  //Pages
  // remove_menu_page( 'edit.php?post_type=page' ); 

  //Comments   
  remove_menu_page( 'edit-comments.php' );          

  //Appearance
  // remove_menu_page( 'themes.php' );              

  //Plugins   
  // remove_menu_page( 'plugins.php' );                

  //Users
  // remove_menu_page( 'users.php' );    
  
  if(!current_user_can('activate_plugins')){             

    //Media
    remove_menu_page( 'upload.php' );     

    //Tools
    remove_menu_page( 'tools.php' );                  

    //Settings
    remove_menu_page( 'options-general.php' ); 

    //ACF Options
    remove_menu_page( 'acf-options' );        
  }
  
}
add_action( 'admin_menu', 'remove_menus', 100 );