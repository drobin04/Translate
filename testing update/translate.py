#pip install nltk googletrans==4.0.0-rc1
import random
from nltk.corpus import wordnet
from googletrans import Translator


import nltk
import random
import time


# Download the NLTK corpora (if not already downloaded)
nltk.download('punkt')
nltk.download('webtext')

# Use the 'webtext' corpus for more modern text content
corpus = nltk.corpus.webtext
sentences = corpus.sents()  # Get sentences from the webtext corpus

# Main loop to generate and output random text phrases at regular intervals
while True:
    random_sentence = ' '.join(random.choice(sentences))  # Select a random sentence

    
    # Translate the random word into Spanish
    translator = Translator()
    translated_word = translator.translate(random_sentence, src='en', dest='es')

    # Print the random English word and its translation in Spanish
    print(f"English: {random_sentence}")
    print(f"Spanish: {translated_word.text}")
    print(random_sentence)

    random_interval = random.randint(5, 10)  # Random interval between 5 to 10 seconds
    time.sleep(2)
