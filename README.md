# CyclePath

The source code of the CyclePath project.

## Build

[![SymfonyInsight](https://insight.symfony.com/projects/0faa11b9-4b07-4797-824a-731be7f735a3/mini.svg)](https://insight.symfony.com/projects/0faa11b9-4b07-4797-824a-731be7f735a3)

## Usage

In order to use this project, you should have Docker & Docker-compose installed, 
once you've installed Docker, time to build the project.

This project use Docker environment files in order to allow the configuration according to your needs,
this way, you NEED to define a .env file in order to launch the build.

**_In order to perform better, Docker can block your dependencies installation and return an error
or never change your php configuration, we recommend to delete all your images/containers
before building the project_**

```bash
docker stop $(docker ps -a -q)
docker rm $(docker ps -a -q)
docker rmi $(docker images -a -q) -f
```

**Note that this command can take several minutes before ending**

Once this is done, let's build the project.

```bash
cp .env.dist .env
make start
```
