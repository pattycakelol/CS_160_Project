# CS_160_Project
CS 160 Project for error and usage analytics on uploaded log files.
The front end was built using HTML, CSS, and JavaScript.
The back end was built using Python, PHP.
Plotly was used as the middleware to connect the Python output to the analytics shown on the front end.

Created by Blanchy Polangcos, Gabriella Yau, Henry Ngo, and Patrick Leung.

# Setup (local)
1. XAMPP
For this project, we used XAMPP to create and test our application.
It can be downloaded here: https://www.apachefriends.org/download.html

2. MySQL
This project uses MySQL for its database, so the correct schema and table need to be made.
A quick tutorial we made (specific to this project) can be found below:
![alt text](http://i.imgur.com/tJve31t.png)

3. Pulling from GitHub
Now we must pull the project from GitHub. Open command prompt/terminal/git bash and cd to 'C:\xampp\htdocs\'.
Enter: 'git pull https://github.com/pattycakelol/CS_160_Project.git'
Or you can download the project here: https://github.com/pattycakelol/CS_160_Project and place it into the htdocs folder.

4. Plotly
In order for graphs to be viewed in the analytics, Plotly must be installed:
```
$ pip install plotly
```
It would be a good idea to utilize a virtual environment to do this wtithin the CS_160_Project folder in C:\xampp\htdocs\, but we didn't.

5. PHP settings
Final step requires that you take the php.ini found in the pulled CS_160_Project folder and place it into C:\xampp\php\ and overwrite the previous php.ini file.

All setup is complete. Head over to 'http://localhost/CS_160_project/' to view the web application.