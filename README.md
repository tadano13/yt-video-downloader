# Youtube Video Downloader

This project provides a simple tool for downloading YouTube videos by entering the URL. It uses PHP for backend processing, and HTML, CSS, and JavaScript for the frontend.

## Table of Contents

- [Installation](#installation)
- [Usage](#usage)
- [Features](#features)
- [Contributing](#contributing)
- [License](#license)
- [Contact](#contact)

## Installation

### Prerequisites

- PHP installed on your server
- A web server (e.g., Apache, Nginx)
- RapidAPI key for accessing the YouTube download API

### Steps

1. Clone the repository:
    ```bash
    git clone https://github.com/tadano13/yt-video-downloader
    ```
2. Navigate to the project directory:
    ```bash
    cd yourproject
    ```
3. Configure your RapidAPI key in the `main.php` file:
    ```php
    // Replace 'your-rapidapi-key' with your actual RapidAPI key
    CURLOPT_HTTPHEADER => [
        "x-rapidapi-host: ytstream-download-youtube-videos.p.rapidapi.com",
        "x-rapidapi-key: your-rapidapi-key"
    ],
    ```
4. Deploy the files to your web server's root directory.

## Usage

1. Open your web browser and navigate to your server's address.
2. Enter a valid YouTube video URL in the input field.
3. Click the "Submit" button.
4. The video will be processed and a download link will be provided.

## Features

- **URL Input**: Enter the URL of the YouTube video you want to download.
- **Validation**: Ensures the input URL is valid before processing.
- **Download Link**: Provides a link to download the video once processed.
- **API LINK**: https://rapidapi.com/ytjar/api/yt-api (get your api for free from  here)

## Project Structure

- `index.html`: The main HTML file containing the form for URL input.
- `home_page.css`: CSS file for styling the HTML page.
- `home_page.js`: JavaScript file for handling form validation and user feedback.
- `main.php`: PHP script for processing the YouTube video URL and fetching the download link via the RapidAPI.

## Contributing

1. Fork the repository.
2. Create a new branch:
    ```bash
    git checkout -b feature-branch
    ```
3. Make your changes and commit them:
    ```bash
    git commit -m "Add new feature"
    ```
4. Push to the branch:
    ```bash
    git push origin feature-branch
    ```
5. Open a pull request.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## Contact

For feedback or support, contact:

- Email: dendropic@gmail.com
- GitHub: tadano (https://github.com/tadano13?tab=repositories)
