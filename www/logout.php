 <?php

	header('Location: index.html'); // Redirects to the beginning.

   # Destroy the session.
   session_start(); 
   
   session_destroy() ;
   

?>