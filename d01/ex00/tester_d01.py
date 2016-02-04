#!/usr/bin/python

# NOTE FOR TANGUY, TIAGO, MARCO:
# I have a couple TODOs that I need to 

# for capturing output from ./push_swap
import shlex
from subprocess import Popen, PIPE

def get_exitcode_stdout_stderr(cmd):
    """
    Execute the external command and get its exitcode, stdout and stderr.
    """
    args = shlex.split(cmd)
    
    proc = Popen(args, stdout=PIPE, stderr=PIPE)
    out, err = proc.communicate()
    exitcode = proc.returncode
    return exitcode, out, err

failed_count = 0

def test(command, expected):
    global failed_count
    try:
        exitcode, out, err = get_exitcode_stdout_stderr(command)
    except:
        print("""The program couldn't execute the command.
My best guess is that you haven't set the permissions on the helper files:
chmod 755 ex0*_tester.php
Other than that, it's possible that the file doesn't exist.
Here's the command for debugging: 
""")
        print(str(command))
        exit(1)
    if (expected == out):
        print("passed: " + str(command))
    else:
       print("FAILED: " + str(command))
       print("expect: |" + str(expected) + "|")
       print("output: |" + str(out) + "|")
       print("error output: |" + str(err) + "|")
       failed_count += 1

# START OF TESTS  START OF TESTS  START OF TESTS  START OF TESTS

# ex00
test("../ex00/hw.php", """Hello World
""")
print("")

# ex01
test("../ex01/mlx.php", "X" * 1000 + "\n")
print("")

# ex02 at bototm of file

# ex03
test('./helper_ex03.php' \
+ ' "Hello    World AAA"' \
+ ' "    b        d  w   r "' \
+ ' " "' \
+ ' ""' \
+ ' "a"' \
+ ' " a"' \
+ ' "a "' \
, """Array
(
    [0] => AAA
    [1] => Hello
    [2] => World
)
Array
(
    [0] => b
    [1] => d
    [2] => r
    [3] => w
)
Array
(
)
Array
(
)
Array
(
    [0] => a
)
Array
(
    [0] => a
)
Array
(
    [0] => a
)
""")
print("")

# exo4
test("../ex04/aff_param.php", "")
test("../ex04/aff_param.php toto ahah foo bar quax", """toto
ahah
foo
bar
quax
""")
test('../ex04/aff_param.php ""', """
""")
test('../ex04/aff_param.php "a"', """a
""")
print("")

# ex05
test('../ex05/epur_str.php', "")
test('../ex05/epur_str.php "Salut, comment ca va ?"', "Salut, comment ca va ?\n")
test('../ex05/epur_str.php "     Hello World     "', "Hello World\n")
print("")

# ex06
test('../ex06/ssap.php', "")
test('../ex06/ssap.php foo bar', """bar
foo
""")
test('../ex06/ssap.php foo bar "yo man" "A moi compte, deux mots" Xibul', """A
Xibul
bar
compte,
deux
foo
man
moi
mots
yo
""")
print("")

# ex07
test('../ex07/rostring.php', "")
test('../ex07/rostring.php sdfkjsdkl sdkjfskljdf', "sdfkjsdkl\n")
test('../ex07/rostring.php "hello world  aaa" fslkdjf', "world aaa hello\n")
test('../ex07/rostring.php "a b" fslkdjf', "b a\n")
test('../ex07/rostring.php "a"', "a\n")
test('../ex07/rostring.php "c b a"', "b a c\n")
test('../ex07/rostring.php "a b c d e f g h i j k l"', "b c d e f g h i j k l a\n")
print("")

# ex08
test('./helper_ex08.php ""', "sorted")
test('./helper_ex08.php "" ""', "sorted")
test('./helper_ex08.php "a b"', "sorted")
test('./helper_ex08.php "a"', "sorted")
test('./helper_ex08.php "c b"', "unsorted")
test('./helper_ex08.php "a b 1"', "unsorted")
test('./helper_ex08.php "a b"', "sorted")
test('./helper_ex08.php "a b c d e f g h i j j"', "sorted")
test('./helper_ex08.php "a b c d e f g h i j j j j j"', "sorted")
test('./helper_ex08.php "a b c d e f g h i j i"', "unsorted")
test('./helper_ex08.php "b a c d e f"', "unsorted")
print("")

test('../ex09/ssap2.php', "")
test('../ex09/ssap2.php toto tutu 4234 "_hop XXX" "##" "1948372 AhAhAh"', """AhAhAh
toto
tutu
XXX
1948372
4234
##
_hop
""")
# TODO: someone some tests here to test the ord thingy
print("")

test('../ex10/do_op.php', "Incorrect Parameters\n")
test('../ex10/do_op.php "" "" "" "fourth"', "Incorrect Parameters\n")
test('../ex10/do_op.php "first" "second"', "Incorrect Parameters\n")
test('../ex10/do_op.php 1 + 3', "4\n")
test('../ex10/do_op.php 1 - 3', "-2\n")
test('../ex10/do_op.php 5 * 3', "15\n")
test('../ex10/do_op.php 9999999 * 189274987', "1892749680725013\n")
print("")

# TODO: I'm here

# END OF TESTS  END OF TESTS  END OF TESTS  END OF TESTS  END OF TESTS

if (failed_count > 0):
    print("FAILED COUNT: " + str(failed_count))
else:
    print("Everything looks good from here!")

print("""

Things to check: 
ls -lR ex*
""")

# ex02
print("Note: ex02 must be checked manually: ../ex02/oddeven.php")
print("""Input ideas:
  42
  0
  -0
  1
  2
  100000000000000000000000000000000000000000000
  -100
  <blank string>
  toto
  99cosmos
Text: 
  "Entrez un nombre: "
  "Le chiffre 42 est Pair"
  "Le chiffre 1 est Impair"
  "'99cosmos' n'est pas un chiffre"
Other:
  C-d to close should exit smoothly
""")