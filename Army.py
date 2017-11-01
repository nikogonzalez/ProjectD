#Army class

'''
Army class will keep track of various units belonging to a player

'''

class Army():
    def __init__(self):
        self._swordsman_count = 0
        self._calvary_count = 0
        self._spearman_count = 0

    @property
    def get_swordsman(self):
        return self._swordsman_count

    def add_swordsman(self, amount):
        self._swordsman_count += amount

    @property
    def get_calvary(self):
        return self._calvary_count

    def add_calvary(self, amount):
        self._calvary_count += amount

    @property
    def get_spearman(self):
        return self._spearman_count

    def add_spearman(self, amount):
        self._spearman_count += amount
