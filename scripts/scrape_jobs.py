import os
import json
import requests
from bs4 import BeautifulSoup
import pandas as pd
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.chrome.service import Service as ChromeService
from webdriver_manager.chrome import ChromeDriverManager
import time

def load_config():
    script_dir = os.path.dirname(os.path.abspath(__file__))
    config_path = os.path.join(script_dir, 'config.json')
    with open(config_path, 'r') as file:
        config = json.load(file)
    return config

def scrape_tes_jobs(url):
    response = requests.get(url)
    soup = BeautifulSoup(response.content, 'html.parser')

    job_titles = []
    locations = []
    dates = []

    jobs = soup.find_all('article', class_='card')

    for job in jobs:
        title = job.find('a', class_='card__title').text.strip()
        location = job.find('span', class_='card__location').text.strip()
        date = job.find('time', class_='card__date').text.strip()

        job_titles.append(title)
        locations.append(location)
        dates.append(date)

    jobs_data = pd.DataFrame({
        'Title': job_titles,
        'Location': locations,
        'Date Posted': dates
    })

    return jobs_data.to_dict(orient='records')

def scrape_indeed_jobs(url):
    driver = webdriver.Chrome(service=ChromeService(ChromeDriverManager().install()))
    driver.get(url)
    time.sleep(3)  # wait for the page to load

    job_titles = []
    locations = []
    dates = []
    descriptions = []

    jobs = driver.find_elements(By.CLASS_NAME, 'result')

    for job in jobs:

        try:
            title = job.find_element(By.CLASS_NAME, 'jobTitle').text.strip()
        except:
            title = "N/A"

        try:
            location = job.find_element(By.CLASS_NAME, 'company_location').text.strip()
        except:
            location = "N/A"

        try:
            description = job.find_element(By.CLASS_NAME, 'jobMetaDataGroup').text.strip()
        except:
            description = "N/A"

        try:
            date = job.find_element(By.CLASS_NAME, 'date').text.strip()
        except:
            date = "N/A"

        job_titles.append(title)
        locations.append(location)
        descriptions.append(description)
        dates.append(date)

    driver.quit()

    jobs_data = pd.DataFrame({
        'Title': job_titles,
        'Location': locations,
        'Description' : descriptions,
        'Date Posted': dates
    })

    return jobs_data.to_dict(orient='records')

if __name__ == '__main__':
    config = load_config()
    tes_jobs = scrape_tes_jobs(config['tes_url'])
    indeed_jobs = scrape_indeed_jobs(config['indeed_url'])

    all_jobs = {
        'tes_jobs': tes_jobs,
        'indeed_jobs': indeed_jobs,
    }

    with open('jobs.json', 'w') as file:
        json.dump(all_jobs, file, indent=4)

    print("Job posts scraped and saved to jobs.json")
