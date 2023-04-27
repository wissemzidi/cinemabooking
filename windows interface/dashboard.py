from PyQt5.QtCore import QDateTime, QDate, QTime
from mysql import connector as mysqli
from PyQt5.uic import loadUi
from PyQt5 import QtWidgets
import datetime
import json
import os

# go to login if is not logged in
with open("session.json", "r") as f:
    data = f.read()
    if len(data) == 0:
        os.system("python login.py")
        exit()

    data = json.loads(data)
    global user_id, access
    user_id = data["id"]
    access = data["access"]


def add_movie():
    name = fen.name.text()
    description = fen.description.text()
    posterURL = fen.posterURL.text()
    seats = fen.seats.text()
    show_date = fen.showDate.text()
    genres = fen.genres.text()

    if (
        (len(name) == 0)
        or (len(description) == 0)
        or (len(posterURL) == 0)
        or (len(seats) == 0)
        or (len(show_date) == 0)
        or (len(genres) == 0)
    ):
        QtWidgets.QMessageBox.critical(fen, "Error", "Please fill all the fields")
        return

    conn = mysqli.connect(
        host="localhost", database="cinemabooking", user="root", password=""
    )
    sql = f"INSERT INTO movies VALUES ('', '{name}', '{description}', '{posterURL}', '{seats}', '{show_date}', '{genres}') ;"
    cursor = conn.cursor()
    cursor.execute(sql)
    conn.commit()

    if cursor.rowcount == 0:
        QtWidgets.QMessageBox.warning(
            fen,
            "Execution error ❌",
            "❌ An Error happened white executing the query,  please try again \t",
        )
    else:
        QtWidgets.QMessageBox.information(
            fen,
            "Success",
            "✅ Movie added successfully \t",
        )
        cancel()

    cursor.close()
    conn.close()
    return


def delete_movie():
    name = fen.name.text()
    show_date = fen.showDate.text()

    if (len(name) == 0) or (len(show_date) == 0):
        QtWidgets.QMessageBox.critical(fen, "Error", "Please fill all the fields")
        return

    conn = mysqli.connect(
        host="localhost", database="cinemabooking", user="root", password=""
    )
    sql = f"DELETE FROM movies WHERE name='{name}' AND showDate='{show_date}' ;"
    cursor = conn.cursor()
    cursor.execute(sql)
    conn.commit()

    if cursor.rowcount == 0:
        QtWidgets.QMessageBox.warning(
            fen,
            "Execution error ❌",
            "❌ An Error happened white executing the query,  please try again \t",
        )
    else:
        QtWidgets.QMessageBox.information(
            fen,
            "Success",
            "✅ Movie Deleted successfully \t",
        )
        cancel()

    cursor.close()
    conn.close()
    return


def edit_movie():
    name = fen.name.text()
    show_date = fen.showDate.text()

    if (len(name) == 0) or (len(show_date) == 0):
        QtWidgets.QMessageBox.critical(fen, "Error", "Please fill all the fields")
        return

    conn = mysqli.connect(
        host="localhost", database="cinemabooking", user="root", password=""
    )
    sql = f"SELECT * FROM movies WHERE name='{name}' AND showDate='{show_date}' ;"
    cursor = conn.cursor()
    cursor.execute(sql)
    res = cursor.fetchall()

    if len(res) == 0:
        QtWidgets.QMessageBox.warning(
            fen,
            "No Movie found",
            "❌ No movie was found with those credentials. \t",
        )
    else:
        initialise_new_fen("edit_movieV2.ui")

        row = res[0]
        fen.name.setText(name)
        fen.description.setText(row[2])
        fen.posterURL.setText(row[3])
        fen.seats.setText(row[4])
        fen.showDate.setDate(
            QDate(int(show_date[0:4]), int(show_date[5:7]), int(show_date[8:10]))
        )
        fen.showDate.setTime(QTime(int(show_date[11:13]), int(show_date[14:16])))
        fen.genres.setText(row[6])
        fen.edit_btn.clicked.connect(edit_movie_2)
        global old_name, old_showDate
        old_name = name
        old_showDate = show_date

    cursor.close()
    conn.close()
    return


def edit_movie_2():
    name = fen.name.text()
    description = fen.description.text()
    posterURL = fen.posterURL.text()
    seats = fen.seats.text()
    show_date = fen.showDate.text()
    genres = fen.genres.text()

    if (
        (len(name) == 0)
        or (len(description) == 0)
        or (len(posterURL) == 0)
        or (len(seats) == 0)
        or (len(show_date) == 0)
        or (len(genres) == 0)
    ):
        QtWidgets.QMessageBox.critical(fen, "Error", "Please fill all the fields")
        return

    conn = mysqli.connect(
        host="localhost", database="cinemabooking", user="root", password=""
    )
    sql = f"""
        UPDATE movies
        SET name='{name}', description='{description}', pic='{posterURL}', seats='{seats}', showDate='{show_date}', genres='{genres}' 
        WHERE name='{old_name}' AND showDate='{old_showDate}' ;
    """
    cursor = conn.cursor()
    cursor.execute(sql)
    conn.commit()

    if cursor.rowcount == 0:
        QtWidgets.QMessageBox.warning(
            fen,
            "Execution error",
            "❌ An Error happened white executing the query,  please try again \t",
        )
    else:
        QtWidgets.QMessageBox.information(
            fen,
            "Success",
            "✅ Movie edited successfully \t",
        )
        cancel()

    cursor.close()
    conn.close()
    return


def delete_user():
    name = fen.name.text()
    show_date = fen.showDate.text()

    if len(email) == 0:
        QtWidgets.QMessageBox.critical(fen, "Error", "Please fill all the fields")
        return

    conn = mysqli.connect(
        host="localhost", database="cinemabooking", user="root", password=""
    )
    sql = f"""DELETE FROM users WHERE email='{email}' ;"""
    cursor = conn.cursor()
    if cursor.execute(sql):
        QtWidgets.QMessageBox.warning(
            fen,
            "Execution error",
            "❌ : An Error happened white executing the query,  please try again \t",
        )
    conn.commit()

    if cursor.rowcount == 0:
        QtWidgets.QMessageBox.warning(
            fen,
            "Unknown user",
            "⚠️︰ No user was found with those credentials. \t",
        )
    else:
        QtWidgets.QMessageBox.information(
            fen,
            "Success",
            "✅ : User Deleted successfully \t",
        )
        cancel()

    cursor.close()
    conn.close()
    return


def nav_buttons():
    fen.addMovie_page.clicked.connect(add_movie_page)
    fen.deleteMovie_btn.clicked.connect(delete_movie_page)
    fen.editMovie_page.clicked.connect(edit_movie_page)
    fen.deleteUser_page.clicked.connect(delete_user_page)
    # fen.editUser_page.clicked.connect(edit_user_page)
    # fen.addAdmin_page.clicked.connect(add_admin_page)
    # fen.delete_admin_page.clicked.connect(delete_admin_page)


def initialise_new_fen(fen_name):
    global fen
    fen.close()
    fen = loadUi(fen_name)
    fen.logout_btn.clicked.connect(logout)
    fen.cancel_btn.clicked.connect(cancel)
    try:
        set_dateNow_input()
    except:
        pass
    nav_buttons()
    fen.show()


def add_movie_page():
    initialise_new_fen("dashboard.ui")
    fen.add_btn.clicked.connect(add_movie)


def delete_movie_page():
    initialise_new_fen("delete_movie.ui")
    fen.delete_btn.clicked.connect(delete_movie)


def edit_movie_page():
    initialise_new_fen("edit_movieV1.ui")
    fen.select_btn.clicked.connect(edit_movie)


def delete_user_page():
    initialise_new_fen("delete_user.ui")
    fen.delete_btn.clicked.connect(delete_user)


def set_dateNow_input():
    global fen
    fen.showDate.setDateTime(datetime.datetime.now())


def cancel():
    try:
        fen.name.setText("")
        fen.showDate.setText("")
        fen.description.setText("")
        fen.posterURL.setText("")
        fen.seats.setText("")
        fen.genres.setText("")
    except:
        pass
    return


def logout():
    with open("session.json", "w") as f:
        f.write("")
    fen.close()
    os.system("python login.py")


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
        exit()
    return


# ************************* Main Program *************************


App = QtWidgets.QApplication([])

# loading main page dashboard.ui
fen = loadUi("dashboard.ui")

# checking the connection
check_connection()

fen.add_btn.clicked.connect(add_movie)
fen.cancel_btn.clicked.connect(cancel)
fen.logout_btn.clicked.connect(logout)

# setting current date and time to the input field.
set_dateNow_input()

# handling the navigation buttons
nav_buttons()

fen.show()
App.exec()
