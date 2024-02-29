import smtplib
import random
import sys

def generate_OTP():
    d = "0123456789"
    OTP = ""
    for i in range(6):
        OTP += random.choice(d)
    msg = "Your OTP is " + OTP
    return msg, OTP

def send_mail(emailid, email_id, apppass, msg):
    try:
        s = smtplib.SMTP('smtp.gmail.com', 587)
        s.starttls()
        s.login(emailid, apppass)
        s.sendmail(emailid, email_id, msg)
        return "Email successfully sent", msg.split()  # Return success message and OTP
    except Exception as e:
        return "Email sending failed", None  # Return failure message and None for OTP

# Main function
if _name_ == "_main_":
    email_id = sys.argv[1]  # Get user's email from command-line argument
    emailid = "haranya135@gmail.com"
    app_password = "nhyl ohcn dsyi zzyv"  # Replace with your Gmail app password
    msg, otp = generate_OTP()
    result, sent_otp = send_mail(emailid,email_id, app_password, msg)
    print("successfully", otp)   # Print the result and OTP