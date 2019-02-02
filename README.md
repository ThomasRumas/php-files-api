# php-files-api
REST API to list files from a repository and get content of files

## Exposed methods
* /files/all.php -> Return folders and files
* /files/get.php -> Return content of files (works on HTML, SVG, TXT...) 

/files/get.php need two parameters : 
* folder -> The folder name, ex: html
* file -> The file you want to get, ex: mySvg.svg

## Example result 
/files/all.php : 
`{
    "michel": [
        "Hop_Into_Spring.svg"
    ],
    "test": []
}`

/files/get.php : 
`"Hello World"`

## Launch it with Docker
This api is available with a Dockerfile to be launch as standalone with Docker.
To use it : 
`docker build --tag apifiles .`
`docker run -p 8080:80 -v /pathToHostWeWantToExpose:/files apifiles`
