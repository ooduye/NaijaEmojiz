<?php
/**
 * Created by PhpStorm.
 * User: andela
 * Date: 10/28/15
 * Time: 1:04 PM
 */

namespace Yemisi\Helper;

class ViewDisplay {

    public static function landing()
    {
        return "<head>" .
        "<style>
			table {
				border-collapse: collapse;
			}
			table, td, th {
				border: 1px solid black;
    			text-align: center;
			}
		</style></head>" .
        "<div style='text-align:center;color:#E5E5E5;'>" .
        "<h1>Welcome to NaijaEmojiz.</h1>" .
        "<span style='font-weight:normal;font-size:16px'>Register <a href='/register'>here</a></span>" .
        "</div>" .
        "<div><table style='width:100%'>" .
        "<tr>
    		<th>EndPoint</th>
    		<th>Functionality</th>
    	</tr>
    	<tr>
    		<td>POST /auth/login</td>
    		<td>Logs a user in</td>
  		</tr>
  		<tr>
    		<td>GET /auth/logout</td>
    		<td>Logs a user out</td>
  		</tr>
  		<tr>
    		<td>GET /emojis</td>
    		<td>Lists all the created emojis</td>
  		</tr>
  		<tr>
    		<td>GET /emojis/{id}</td>
    		<td>Gets a single emoji</td>
  		</tr>
  		<tr>
    		<td>POST /emojis</td>
    		<td>Creates a new emoji</td>
  		</tr>
  		<tr>
    		<td>PUT /emojis/{id}</td>
    		<td>Updates an emoji</td>
  		</tr>
  		<tr>
    		<td>PATCH /emojis/{id}</td>
    		<td>Partially updates an emoji</td>
  		</tr>
  		<tr>
    		<td>DELETE /emojis/{id}</td>
    		<td>Deletes a single emoji</td>
  		</tr>
  		<tr>
    		<td>GET /register</td>
    		<td>Displays user registration form (For registration via browser only!)</td>
  		</tr>
  		<tr>
    		<td>POST /register</td>
    		<td>Creates a user account</td>
  		</tr>
  		<tr>
    		<td>PATCH /user/{username}</td>
    		<td>Changes password of a user</td>
  		</tr>
  		<tr>
    		<td>DELETE /user/{username}</td>
    		<td>Deletes a user account</td>
  		</tr>
  		<tr>
    		<td>GET /</td>
    		<td>Displays a Welcome page</td>
  		</tr>
		</table></div>";
    }
    /**
     * Display user registration form
     *
     * @return string User registration form
     */
    public static function registerForm()
    {
        return "<div style='padding-left:450px;padding-top:200px'>" .
        "<form action='/register' method='post'>" .
        "Name: <input type='text' required autocomplete='off' name='name' placeholder='Enter your name' /><br><br>" .
        "Username: <input type='text' required autocomplete='off' name='username' placeholder='Enter a username' /><br><br>" .
        "Password: <input type='password' required autocomplete='off' name='password' placeholder='Enter a password' /><br><br>" .
        "Confirm Password: <input type='password' required autocomplete='off' name='password1' placeholder='Enter the password once more' /><br><br>" .
        "Purpose: <textarea name='purpose' required maxlength='50' rows='4' cols='50' placeholder='Why do you want to use our service?'></textarea><br><br>" .
        "<input type='submit' value='Register' />" .
        "</form>" .
        "</div>";
    }

}