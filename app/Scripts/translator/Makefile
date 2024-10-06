NAME			=	nasa

SRC_DIR		=	./src/
OBJ_DIR		=	obj/

INC_DIR	=	./includes/

MAIN_INC	= -I $(INC_DIR)

HDRS		= 	$(shell find $(INC_DIR) -type f -name "*.h")

SRC			=	main.cpp
OBJ			=	$(addprefix $(OBJ_DIR), $(SRC:.cpp=.o))

CC				=	c++
CFLAGS			=	-Wall -Wextra -Werror -std=c++11

$(OBJ_DIR)%.o:	$(SRC_DIR)%.cpp $(HDRS) Makefile
		@mkdir -p $(OBJ_DIR)
		$(CC) ${CFLAGS}  $(MAIN_INC) -o $@ -c $<

$(NAME)		:	$(OBJ) $(HDRS)
		$(CC) $(CFLAGS) $(OBJ) $(MAIN_INC) -o $(NAME)
					
all			:	$(NAME)

clean		:
		@rm -rf $(OBJ_DIR)

fclean		:	clean
		@rm -rf $(NAME)

re			:	fclean	all

.PHONY		:	all clean fclean re