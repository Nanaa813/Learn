import datetime

class Schedule:
    def __init__(self):
        self.events = {}

    def add_event(self, name, date, time):
        """Add a new event to the schedule"""
        event_date = datetime.datetime.strptime(f"{date} {time}", "%Y-%m-%d %H:%M")
        if event_date in self.events:
            print("Event already exists at this time.")
        else:
            self.events[event_date] = name
            print("Event added successfully.")

    def delete_event(self, date, time):
        """Delete an event from the schedule"""
        event_date = datetime.datetime.strptime(f"{date} {time}", "%Y-%m-%d %H:%M")
        if event_date in self.events:
            del self.events[event_date]
            print("Event deleted successfully.")
        else:
            print("No event found at this time.")

    def view_schedule(self):
        """View all events in the schedule"""
        for event_date, name in self.events.items():
            print(f"{event_date.strftime('%Y-%m-%d %H:%M')}: {name}")


def main():
    schedule = Schedule()

    while True:
        print("\n1. Add Event")
        print("2. Delete Event")
        print("3. View Schedule")
        print("4. Quit")

        choice = input("Choose an option: ")

        if choice == "1":
            name = input("Enter event name: ")
            date = input("Enter event date (YYYY-MM-DD): ")
            time = input("Enter event time (HH:MM): ")
            schedule.add_event(name, date, time)
        elif choice == "2":
            date = input("Enter event date (YYYY-MM-DD): ")
            time = input("Enter event time (HH:MM): ")
            schedule.delete_event(date, time)
        elif choice == "3":
            schedule.view_schedule()
        elif choice == "4":
            break
        else:
            print("Invalid option. Please choose again.")

if __name__ == "__main__":
    main()