# TYPO3 Extension context_ribbon
## What does it do?

The extension shows a ribbon in the right top corner of the frontend and backend.

It supports the following states:

* Development
* Development/Staging
* Testing
* Production/Staging
* Production

![development ribbon](Documentation/Images/development.png)
![testing ribbon](Documentation/Images/testing.png)
![staging ribbon](Documentation/Images/staging.png)
![production ribbon](Documentation/Images/production.png)

## Usage

Install the extension and set the application context: https://docs.typo3.org/typo3cms/extensions/bsdist/Main/ApplicationContext/Index.html

Restart your webserver server and the ribbon is shown.

You can switch off/on the ribbon in the frontend by adding the static extension template to your main template.

The ribbon is hidden in production context automatically!
