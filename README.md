# Pedal Plan

Pedal Plan tries to find the safest possible route for your journey by bike. Our algorithm take into account historic accident, weather and live traffic congestion data to try and find the route with the fewest risks without compromising on journey time. When you're on the move you sometimes may not have a data connection; if you can't access our website for whatever reason, you can send us a text and we'll reply with directions for the safest route by bike.

Our website uses a SQLite3 database to store historic accident data and enable us to filter and this data quickly. PHP controls the database and processes most of the data, as well as making all necessary API calls to Google Maps, Bing Maps, the Open Weather Map and Clockwork. The results are then presented to the user with the help of HTML, CSS and a bit of JavaScript.

Pedal Plan is built in such a way as to allow for easy expansion. In the future we envision producing native mobile apps for major platforms such as Android and iOS and developing a way to access live step-by-step instructions for navigation whilst riding your bike.

# Licence

Copyright (c) Alexander Nielsen, Carl Ntifo and Oliver Cole 2015. Licenced under a [Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International Licence](http://creativecommons.org/licenses/by-nc-sa/4.0/ "CC BY-NC-SA 4.0 Licence").
