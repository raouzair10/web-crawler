# Matched URLs Webpage

This project is a basic HTML webpage that displays matched URLs based on a specified search string. The page is styled using CSS to provide a visually appealing and responsive layout.

## Features

- **Stylish Layout:** The webpage has a clean and centered design, making it visually appealing.
- **Clickable URLs:** Crawled URLs are presented as clickable links, allowing users to open them in a new tab.
- **Time Limit:** The PHP script has a time limit set to prevent the execution from running indefinitely.
- **Search and Display:** The script searches for a specified string in the HTML content and displays matched URLs.

## Usage

1. Open the HTML file ('index.html') in a web browser.
2. Input the search string and seed URL in the provided form.
3. Click the "Search" button to initiate the web crawling process.
4. The matched URLs will be displayed on the webpage.

## Styling

The webpage uses a modern and responsive design, utilizing the following styles:

- **Background:** Light gray background for readability.
- **Header:** Blue header with white text for emphasis.
- **List Items:** White background with a subtle box shadow for each URL.
- **URLs:** Blue color for clickable URLs, turning underline on hover.
- **Footer:** Gray footer for additional information.

## PHP Script

The PHP script embedded in the HTML file performs the following tasks:

- Fetches HTML content from specified URLs.
- Extracts links from the HTML content and adds them to the crawling queue.
- Searches for a specified string in the HTML content and displays matched URLs.

### Script Configuration

- **Time Limit:** The PHP script has a time limit set to 120 seconds. Adjust as needed ('set_time_limit(120)').

- **Depth Limit:** The maximum crawling depth is set to 1. You can modify the '$depthLimit' variable to change this.
