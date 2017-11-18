
# Ecology Monitoring Unit - EcoBot

## Hardware 

- Raspberry PI3+ model B or similar unit
- DHT22 temperature  & humidity sensor
- SDS011 dust micro parts and smog lazer sensor ( 2,5 & 10 micrometers )

## Software

### EcoTower - Server aggregator application

It is separate project with their own repo
 
### EcoBot - ecology monitoring unit ( current repo )

- Host OS ( Raspbian as usually out-of-box on Rapsberry PI)
- Python packages for sensors
- Cron jobs for scheduled tasks
- MySQL as a storage engine
- php Yii2 based application

#### Structure of php Yii2 application

```
common
    config/              contains shared configurations
    models/              contains model classes used in both backend and frontend
    tests/               contains tests for common classes    
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    commands/            contains bash executive coomands for project
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
frontend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains frontend configurations
    controllers/         contains Web controller classes
    models/              contains frontend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for frontend application
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains frontend widgets
vendor/                  contains dependent 3rd-party packages
```