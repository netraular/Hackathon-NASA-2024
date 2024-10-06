#include <iostream>
#include <fstream>
#include <sstream>
#include <string>
#include <vector>
#include <cmath>
#include "DataLib.h"
#include "CelestialBodyLib.h"

int main() {
    std::vector<ExoPlanet>  planets;
    std::string CSVFile = "./output.csv";

    try {
        std::ifstream reader(CSVFile.c_str());
        if (!reader.is_open()) {
            throw std::runtime_error("Could not open the file.");
        }

        std::string line;
        bool isFirstLine = true;
        int i = 0;

        while (std::getline(reader, line)) {
            if (isFirstLine) {
                isFirstLine = false;
                continue;
            }

            std::stringstream ss(line);
            std::string values[7];

            for (int col = 0; col < 7; col++) {
                std::getline(ss, values[col], ',');
                // std::cout << "Columna " << col + 1 << ": " << values[col] << std::endl;
            }

            if (i % 2000 == 0)
            {
                ExoPlanet newPlanet(values[0], values[1], std::stod(values[5]),std::stod(values[2]),std::stod(values[3]));
                planets.push_back(newPlanet);
            }
            else
            {
                Star    newStar(values[0], std::stod(values[5]),std::stod(values[2]),std::stod(values[3]));
                planets[0].push_star(newStar);
            }
            i++;
        }

        std::vector<ExoPlanet>::iterator    begin = planets.begin();
        std::vector<ExoPlanet>::iterator    end = planets.end();  

        for (; begin != end; begin++)
        {
            std::cout << begin->GetName() << std::endl;
        }

        reader.close();
    } catch (const std::exception& ex) {
        std::cout << "Error: " << ex.what() << std::endl;
    }

    return 0;
}
