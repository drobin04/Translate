#
# PURPOSE OF THIS SCRIPT: Dump data from an export of Discord messages, into a translations.csv file.
#     Works by using a regex to strip out the two participants' names from the messages (as many lines are just there for a header of who sent the message), 
#     And then for each message, split it into sentences, send each sentence to google translate to be translated into spanish and french, and then populate CSV with them.
#     
#


#pip install nltk googletrans==4.0.0-rc1
from bs4 import BeautifulSoup
import re
from googletrans import Translator

# UPDATE THESE VARIABLES TO INCLUDE THE USERNAMES THAT NEED TO BE SKIPPED!
username_to_skip_1 = 'Username1'
username_to_skip_2 = 'Username2'
file_path = 'Z:\Data\project\dms.html'  # Replace with the actual file path





skip_values_regex = r'\b\d{1,2}/\d{1,2}/\d{4} \d{1,2}:\d{2} [AP]M\b|' + username_to_skip_1 + '|' + username_to_skip_2  # Updated regex pattern


# Function to extract text inside <span> elements from the HTML file, skipping specific values using regex
def extract_span_text_from_file(file_path, skip_values_regex):
    with open(file_path, 'r', encoding='utf-8') as file:
        html_content = file.read()
        soup = BeautifulSoup(html_content, 'html.parser')
        span_texts = [span.get_text() for span in soup.find_all('span') if not re.match(skip_values_regex, span.get_text())]
        return span_texts

# Function to display each message one by one
def display_messages(messages):
    for message in messages:
        process_msg(message)

def process_msg(msg):
    # If contains a URL, remove it
    url_pattern = r'https?://\S+'
    result_string = re.sub(url_pattern, '', msg)
    messages = result_string.split('.')
    for message in messages:
        if len(message) >= 4 and message != '(edited)':
            try:
                translate_and_store(message.strip())

            except Exception as e:
                print('error during translating... ')
def translate_and_store(msg):
    # Translate the random word into Spanish
    translator = Translator()
    spanish_word = translator.translate(msg, src='en', dest='es').text
    french_word = translator.translate(msg, src='en', dest='fr').text


    from csv import writer

    # Open the existing CSV file in append mode
    with open('translations.csv', 'a', newline='') as file:
        csv_writer = writer(file)
        # Append a list as a new row into the existing CSV file
        csv_writer.writerow([msg, spanish_word,french_word])
    #value = '"' + msg + '","' + spanish_word + '"'

span_texts = extract_span_text_from_file(file_path, skip_values_regex)
display_messages(span_texts)
