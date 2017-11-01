#Minimal RST
#Player class
import sys
import Army

'''
Player Class keeps track of player related information

'''

class Player ():
    def __init__(self,user_name):
        self._army = Army
        self._user_name
        self._faction
        self._resource

    @property
    def get_resource(self):
        return self._resource

    def add_resource(self, amount):
        self._resource += amount;

    @property
    def get_faction(self):
        return self._faction
