/**
 * Handles form submission and validation for a URL input field.
 *
 * Listens for the DOMContentLoaded event to ensure the form and input elements are available.
 * Then, it adds an event listener to the form's submit event to validate the URL input field.
 * If the input field is empty, it prevents the form submission, displays an error message, and hides the thank you message.
 * If the input field is not empty, it hides the error message, displays the thank you message, and scrolls to the thank you message.
 *
 * @example
 * <html>
 *   <body>
 *     <form>
 *       <input id="url" type="text" placeholder="Enter URL">
 *       <button type="submit">Submit</button>
 *     </form>
 *     <div id="errorMessage" style="display: none;">Please enter a valid URL.</div>
 *     <div id="thankYouMessage" style="display: none;">Thank you for submitting the URL!</div>
 *     <script src="script.js"></script>
 *   </body>
 * </html>
 */
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const urlInput = document.getElementById('url');
    const errorMessage = document.getElementById('errorMessage');
    const thankYouMessage = document.getElementById('thankYouMessage');
  
    form.addEventListener('submit', function(event) {
      if (urlInput.value.trim() === "") {
        event.preventDefault();
        errorMessage.style.display = 'block';
        thankYouMessage.style.display = 'none';
      } else {
        errorMessage.style.display = 'none';
        thankYouMessage.style.display = 'block';
        thankYouMessage.scrollIntoView({ behavior: 'smooth' });
      }
    });
  
    form.style.margin = '0 auto';
    form.style.textAlign = 'left';
  });