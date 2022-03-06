from PIL import Image
def compare_lines(img,line1,line2):
    return set(get_line(img,line1)) - set(get_line(img,line2))

def get_line(img,line):
    width, height = img.size
    pixels = []
    for x in range(0,width-1):
        pixels.append(img.getpixel((x,line)))
    return pixels

def get_charcount(img):
    width, height = img.size
    count = 0
    for i in range(height - 1):
        comp = compare_lines(img,i,height - 1)
        if len(comp) != 0:
            count += 1
        else:
            break
    return count

# open image
img = Image.open('bluer.png')
width, height = img.size
# get total for lastline as a reference
lastline = get_line(img,height - 1)
lastlinetotal = 0
for i in range(len(lastline)):
    pixel = list(lastline[i])
    lastlinetotal = lastlinetotal + (pixel[0] + pixel[1] + pixel[2])
ref = lastlinetotal

# count number or char in flag
charcount = get_charcount(img)
print('Flag has ' + str(charcount) + ' chars')

# get total for each line from start to 'charcount' substract reference
# this number represent the number of increment that happened on the line AND the charcode
flag = ''
for y in range(charcount):
    line = get_line(img,y)
    linetotal = 0
    for i in range(len(line)):
        pixel = list(line[i])
        linetotal = linetotal + (pixel[0] + pixel[1] + pixel[2])
    charcode = linetotal - ref
    flag = flag + chr(charcode)

print('Flag: ' + flag)
