from PyQt5 import QtWidgets
from PyQt5.uic import loadUi
import mysql.connector as mysqli
import bcrypt
import json
import sys
import os


def check_session():
    if os.path.exists("session.json"):
        with open("session.json", "r") as f:
            data = f.read()
            if len(data) == 0:
                return
            data = json.loads(data)
            conn = mysqli.connect(
                host="localhost", database="cinemabooking", user="root", password=""
            )
            sql = f"SELECT * FROM admins WHERE id='{data['id']}' ;"
            cursor = conn.cursor()
            cursor.execute(sql)
            rows = cursor.fetchall()
            if len(rows) != 0:
                # os.system("python dashboard.py")
                os.system("dashboard.exe")
                sys.exit()


def login():
    email = fen.email.text()
    pwd = fen.pwd.text()

    if (len(email) == 0) or (len(pwd) == 0):
        QtWidgets.QMessageBox.warning(fen, "Error", "Please fill all the fields")
        return

    conn = mysqli.connect(
        host="localhost", database="cinemabooking", user="root", password=""
    )
    sql = f"SELECT * FROM admins WHERE email='{email}' ;"
    cursor = conn.cursor()
    cursor.execute(sql)
    rows = cursor.fetchall()
    if len(rows) == 0:
        QtWidgets.QMessageBox.warning(
            fen, "wrong credentials", "No account with this email"
        )
        cursor.close()
        conn.close()
        return

    row = rows[0]
    hashed_pwd = row[3]

    if not bcrypt.checkpw(pwd.encode(), hashed_pwd.encode()):
        QtWidgets.QMessageBox.warning(fen, "wrong credentials", "Wrong Password")
        cursor.close()
        conn.close()
        return

    fen.error.setText("")
    cursor.close()
    conn.close()
    fen.close()
    with open("session.json", "w") as f:
        data = {"id": row[0], "name": row[1], "email": row[2], "access": row[4]}
        f.write(json.dumps(data))
    # os.system("python dashboard.py")
    os.system("dashboard.exe")
    return


def cancel():
    fen.email.setText("")
    fen.pwd.setText("")
    return


def check_connection():
    try:
        conn = mysqli.connect(
            host="localhost", database="cinemabooking", user="root", password=""
        )
    except:
        fen.close()
        msg = QtWidgets.QMessageBox.critical(
            fen,
            "Connection error ⚠️",
            "No connection to the Database or the Internet, please check your connection. \t",
        )
        sys.exit()
    return


# ************************* Main Program *************************


check_session()
App = QtWidgets.QApplication(sys.argv)

fen = loadUi("interfaces/login_interface.ui")

# checking connection to database
check_connection()

fen.login_btn.clicked.connect(login)
fen.cancel_btn.clicked.connect(cancel)

fen.show()
App.exec()
