from PyQt5 import QtWidgets
from PyQt5.uic import loadUi
import mysql.connector as mysqli
import bcrypt
import json
import os


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
    os.system("python dashboard.py")
    return


def cancel():
    fen.email.setText("")
    fen.pwd.setText("")
    return


class Admin:
    def __init__(self, id: int, name: str, email: str, access: int):
        self.id = id
        self.name = name
        self.email = email
        self.access = access

    def get_access(self):
        return self.access

    def max_control(self):
        if self.access == 3:
            return 2
        elif self.access == 2:
            return 1
        else:
            return 0


App = QtWidgets.QApplication([])
fen = loadUi("login_interface.ui")

fen.login_btn.clicked.connect(login)
fen.cancel_btn.clicked.connect(cancel)

fen.show()
App.exec()
