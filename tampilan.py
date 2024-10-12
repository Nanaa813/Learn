users = {
    "admin": "password123",
    "user1": "hello123",
    "user2": "world123"
}

def login(username, password):
    """
    Check if the username and password are valid
    """
    if username in users and users[username] == password:
        return True
    else:
        return False

def main():
    """
    Main function to handle login
    """
    print("Login System")
    print("------------")

    username = input("Enter your username: ")
    password = input("Enter your password: ")

    if login(username, password):
        print("Login successful!")
    else:
        print("Invalid username or password")

if __name__ == "__main__":
    main()