<?php
if (!isset($_SESSION))
{
    session_start();

}

if(!isset($_SESSION['active']))
{
    echo "<script>window.open('home','_self')</script>";
}

function bar()
{
    $output = "";
      $output .= ' <ul class="nav navbar-nav"> ' ;
		if (isset($_SESSION['admin']))
        {
            $output .= 
            '
            <li><a href="adminprofile">Profile</a></li>
            <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false">Events <i class="fa fa-angle-down"></i></a>
            <ul class="dropdown-menu">
            <li><a href="events">Create Events</a></li>    
            <li><a href="view_events">View Events</a></li>
            </ul>
            <li><a href="labs">Labs</a></li>    
            ';
        }	
        else
        {
            $output .= 
            '
            			<li class="dropdown">
					  <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false">Profile <i class="fa fa-angle-down"></i></a>
					  <ul class="dropdown-menu">
                       <li><a href="personal">Personal</a></li>    
		
            ';
     				 if (isset($_SESSION['lead'])){
    		$output .='<li><a href="labusers">Lab Users</a></li>    
                       <li><a href="lab">Lab</a></li>
                       </ul>
                       </li>
                       <li><a href="instruments">Instruments</a></li>
                       ';    
        
                    }else{
                        $output .= "</ul></li>";

                    } 


             $output .=
             '
         			<li><a href="subs">Subscriptions</a></li>    
					<li><a href="test">Test Events</a></li>    
					<li><a href="report">Report Log</a></li>    
			
             ';    
             
             
        }	

				$output .='	
           		<li><a href="logout">Logout</a></li>
		        </ul>';
		echo $output;
}
?>