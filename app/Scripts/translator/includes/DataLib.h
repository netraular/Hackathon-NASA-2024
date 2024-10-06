#ifndef DATALIB_H
#define DATALIB_H

class Data {
private:
    double distance;
    double RA;
    double DEC;

public:
    Data(double distance, double RA, double DEC) : distance(distance), RA(RA), DEC(DEC) {}

    Data SphericalTransData(const Data& ref_data) const {
        double ref_distance = ref_data.getDistance();
        double ref_DEC = ref_data.getDEC();
        double ref_RA = ref_data.getRA();
        double theta = 90 - DEC;

        double xs = ref_distance * cos(ref_DEC) * cos(ref_RA) - distance * cos(DEC) * cos(RA);
        double ys = ref_distance * cos(ref_DEC) * sin(ref_RA) - distance * cos(DEC) * sin(RA);
        double zs = ref_distance * sin(ref_DEC) - DEC * sin(DEC);

        double xs2 = cos(theta) * cos(RA) * xs + cos(theta) * sin(RA) * ys - sin(theta) * zs;
        double ys2 = -sin(RA) * xs + cos(RA) * ys;
        double zs2 = sin(theta) * cos(RA) * xs + sin(theta) * sin(RA) * ys + cos(theta) * zs;

        return Data(sqrt(pow(xs2, 2) + pow(ys2, 2) + pow(zs2, 2)), asin(zs2 / sqrt(pow(xs2, 2) + pow(ys2, 2) + pow(zs2, 2))), atan2(ys2, xs2));
    }

    double ExoPlanetToStarDistance(double DistExo) const {
        return sqrt(abs(pow(distance, 2) - pow(DistExo, 2)));
    }

    double getDistance() const { return distance; }
    double getRA() const { return RA; }
    double getDEC() const { return DEC; }

    void setDistance(double distance) { this->distance = distance; }
    void setRA(double RA) { this->RA = RA; }
    void setDEC(double DEC) { this->DEC = DEC; }
};

#endif
