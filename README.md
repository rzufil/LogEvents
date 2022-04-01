
# LogEvents - Magento 2

# Description
LogEvents is a Magento 2 module that logs all the events dispatched by Magento.

I also has a CLI that allows you to log the events from different config reader scopes.

Scope options are:

- global
- adminhtml
- crontab
- frontend
- graphql
- webapi_rest
- webapi_soap

# Requirements
- PHP **7.x.x** or higher
- MySQL **8.x.x** or higher

# Installation
It is possible to install the LogEvents module for Magento 2 via [.zip](https://github.com/rzufil/LogEvents/archive/main.zip) or via [Git](https://github.com).

#### Via [git](https://github.com)
- Go to the Magento root directory and add the module
    - `git clone https://github.com/rzufil/LogEvents.git app/code/Rzufil/LogEvents/`
- Update the available Magento modules
    - `bin/magento setup:upgrade`
- The ​**LogEvents**​​ module should be displayed in the list of Magento modules
    - `bin/magento module:status`

#### Via [.zip](https://github.com/rzufil/LogEvents/archive/main.zip)
- Create the following folder (s) inside the Magento ​app​​ folder
    - `code/Rzufil/LogEvents`
- Download [.zip](https://github.com/rzufil/LogEvents/archive/main.zip)
- The path should be ​**app / code / Rzufil / LogEvents**
- Extract the **​.zip**​​ files into the ​**LogEvents** folder
- In the root directory, update the available Magento modules
    - `bin/magento setup:upgrade`
- The **Rzufil_LogEvents** module should be displayed in the list of Magento modules
    - `bin/magento module:status`

# Configuration
1. Setting up LogEvents
    - In the Magento Administration panel, go to ​**Stores -> Configuration -> Log Events -> Configuration**
    - In the **General Configuration** group, you can **Enable** or **Disable** events logging
