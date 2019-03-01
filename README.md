# php-files-api
REST API to list files from a repository and get content of files

## Exposed methods
* /all -> Return folders and files
* /get/folderName/fileName -> Return content of files (works on HTML, SVG, TXT...) 

/files/get.php need two parameters : 
* folderName -> The folder name, ex: html
* fileName -> The file you want to get, ex: mySvg.svg

## Example result 
/all : 
`{
    "michel": [
        "Hop_Into_Spring.svg"
    ],
    "test": []
}`

/get/<folder>/<file> : 
`"Hello World"`

## Launch it with Docker
This api is available with a Dockerfile to be launch as standalone with Docker.

To use it : 

`docker build --tag apifiles .`

`docker run -p 8080:80 -v /pathToHostWeWantToExpose:/files apifiles`
