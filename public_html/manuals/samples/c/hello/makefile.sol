#DEBUG

C_FLAGS = 

CC = CC

all: hello hello.xpl

hello: hello.c
	$(CC) -I$(AMZI_DIR)/include -L$(AMZI_DIR)/lib $(C_FLAGS) -lamzi -o hello hello.c

hello.xpl: hello.pro
	acmp hello
	alnk hello hello
