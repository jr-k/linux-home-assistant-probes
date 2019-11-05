import time
import subprocess

while True:
	time.sleep(3)
	subprocess.run(['cputemp'])
