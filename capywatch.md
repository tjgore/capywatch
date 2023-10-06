# Tighten Code Challenge

We would like to be able to track the daily movements of our three prized capybaras, named Colossus, Steven, and Capybaby. Write a Laravel API that:

1. Allows users to submit a capybara observation:
    - Each observation must include the capybara's name, the date, and the city where they were spotted. We are only interested in their movements in Chicago, Atlanta, New York, Houston, and San Francisco.
    - With each observation, users can optionally indicate whether or not the capybara was wearing a hat that day.
    - We only want to collect one observation per capybara/city/date: i.e., if two people spot the same capybara in Chicago on the same day, we only want to record the first observation.

2. Allows users to add a new capybara to be tracked:
    - New capybara submissions should include the animal's name, color, and size.

3. Includes whatever tests you feel are necessary to prove that your API is working correctly. These tests should at least verify:
    - That only the first observation per capybara/city/date is recorded
    - That a new capybara cannot have the same name as an existing capybara

4. Create a simple UI, using either Vue.js, React, or Livewire, that allows a user to submit a capybara observation, and which displays any validation errors that occur during their submission.


## Delivering this application

To deliver your code challenge submission, deliver us your fully-functioning Laravel application to matt@tighten.co either as a ZIP file or as a link to a private GitHub repository.