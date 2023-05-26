from email.mime.multipart import MIMEMultipart
from email.mime.text import MIMEText
import smtplib
import json


erreur_msg = ""


def send_auth_email():
    try:
        with open("transfer.json", "r") as f:
            data = json.loads(f.read())
            rec_email = data["email"]
            verif_code = data["verif_code"]
    except Exception:
        erreur_msg = "the data transferring didn't work"
        return

    try:
        server = smtplib.SMTP("smtp.gmail.com", 587)
        server.starttls()
        server.login("wissem.zidi.ofc@gmail.com", "pavlbipvzvklejam")
    except Exception:
        erreur_msg = "Erreur while login in to the smtp server"
        return

    try:
        msg = MIMEMultipart("alternative")
        msg["Subject"] = "Authentification code"
        msg["From"] = "Cinemabooking"
        msg["To"] = rec_email
        with open("./auth_template/index.html", "r") as f, open(
            "./auth_template/style.css", "r"
        ) as f2:
            html = f.read()
            html_msg = f"{html}".format(verif_code=verif_code)

            # appending the css
            css = f2.read()
            html_msg += f""" 
            <style type='text/css'>
                {css}
            </style>
            """
        msg.attach(MIMEText(html_msg, "html"))
    except Exception:
        erreur_msg = "Erreur while parsing the html"
        return

    try:
        # sending email
        server.sendmail("Cinemabooking", rec_email, msg.as_string())
    except Exception:
        erreur_msg = "Erreur while sending the email"

    try:
        server.quit()
    except Exception:
        pass


# ********** Principal Program *********** #

send_auth_email()


# empty the transfer.json file
with open("transfer.json", "w") as f:
    f.write(json.dumps({"erreur_msg": erreur_msg}))
